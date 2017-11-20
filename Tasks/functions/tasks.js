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

const newTask = (req, res, next) => {
    const uid = req.query.uid;
    const title = req.query.title;
    const description = req.query.description;
    const dueDate = req.query.dueDate;
    const reminder = req.query.reminder;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid).push({
        title: title,
        desciption: description,
        dueDate: dueDate,
        reminder: reminder
    }).then((key) => {
        res.status(200);
        res.send(key.key);
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

const editTask = (req, res, next) => {
    const uid = req.query.uid;
    const tid = req.query.tid;
    const title = req.query.title;
    const description = req.query.description;
    const dueDate = req.query.dueDate;
    const reminder = req.query.reminder;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid+'/'+tid).set({
        title: title,
        desciption: description,
        dueDate: dueDate,
        reminder: reminder
    }).then(() => {
        res.status(200);
        res.send(tid);
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

const deleteTask = (req, res, next) => {
    const uid = req.query.uid;
    const tid = req.query.tid;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid+'/'+tid).remove().then(() => {
        res.status(200);
        res.send(tid);
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

const completeTask = (req, res, next) => {
    const uid = req.query.uid;
    const tid = req.query.tid;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid+'/'+tid+'/complete').set(true).then(() => {
        res.status(200);
        res.send(tid);
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

const todayTasks = (req, res) => {
    const uid = req.query.uid;
    if (req.method !== 'GET') {
        return handleResponse(uid, 403);
    }

    const start = new Date();
    start.setHours(0,0,0,0);

    const end = new Date();
    end.setHours(23,59,59,999);

    return admin.database().ref('tasks/'+uid).orderByChild('dueDate').startAt(start.getTime()).endAt(end.getTime()).once('value').then((tasks) => {
        res.status(200);
        res.send(tasks.val());
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};
const allTasks = (req, res) => {
    const uid = req.query.uid;
    if (req.method !== 'GET') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid).once('value').then((tasks) => {
        res.status(200);
        res.send(tasks.val());
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};
const delayedTasks = (req, res) => {
    const uid = req.query.uid;
    if (req.method !== 'GET') {
        return handleResponse(uid, 403);
    }

    const end = new Date();

    return admin.database().ref('tasks/'+uid).orderByChild('dueDate').endAt(end.getTime()).once('value').then((tasks) => {
        res.status(200);
        res.send(tasks.val());
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

app.use('/new', newTask);
app.use('/edit', editTask);
app.use('/delete', deleteTask);
app.use('/complete', completeTask);
app.get('/dueToday', todayTasks);
app.get('/delayed', delayedTasks);
app.get('/all', allTasks);

exports.task = functions.https.onRequest(app);