'use strict';

const admin = require('firebase-admin');
const functions = require('firebase-functions');
const bodyParser = require('body-parser');
const express = require('express');
const cors = require('cors')({origin: true});
const app = express();
const serviceAccount = require("./serviceAccountKey.json");
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

admin.initializeApp({
    credential: admin.credential.cert(serviceAccount),
    databaseURL: "https://architecture-project-2017.firebaseio.com"
});

const handleResponse = (email, status, body) => {
    console.log({
        User: email
    }, {
        Response: {
            Status: status,
            Body: body
        }
    });
    if (body) {
        return res.status(200).json(body);
    }
    return res.sendStatus(status);
};

const newAccount = (req, res, next) => {
    const email = req.query.email;
    const name = req.query.name;
    const birthday = req.query.birthday;

    if (req.method !== 'POST') {
        return handleResponse(email, 403);
    }

    return admin.auth().createUser({
        email: email,
        emailVerified: false,
        password: 'password',
        displayName: name,
        disabled: false
    }).then(function (userRecord) {
        // See the UserRecord reference doc for the contents of userRecord.
        console.log("Successfully created new user:", userRecord.uid);
        let newAccount = {};
        newAccount.email = email;
        newAccount.name = name;
        newAccount.birthday = birthday;
        return admin.database().ref('users/'+userRecord.uid).set(newAccount).then(() => {
            res.status(200);
            res.send(userRecord.uid);
        }).catch(function (error){
            res.status(404).json({ error: error }).end();
            console.log("Error creating new user:", error);
        });
    }).catch(function (error) {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new user:", error);
    })
};

app.use(newAccount);

exports.newAccount = functions.https.onRequest(app);