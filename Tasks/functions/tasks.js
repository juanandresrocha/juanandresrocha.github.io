'use strict';

const admin = require('firebase-admin');
const functions = require('firebase-functions');
const bodyParser = require('body-parser');
const express = require('express');
const cors = require('cors');
const app = express();
const serviceAccount = require("./serviceAccountKey.json");

app.use(cors({origin: true}));
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
    const descripcion = req.query.descripcion;
    const dueDate = req.query.dueDate;
    const reminder = req.query.reminder;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid).push({
        title: title,
        descripcion: descripcion,
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

const editTask = (req, res) => {
    const uid = req.query.uid;
    const tid = req.query.tid;
    const title = req.query.title;
    const descripcion = req.query.descripcion;
    const dueDate = req.query.dueDate;
    const reminder = req.query.reminder;

    if (req.method !== 'POST') {
        return handleResponse(uid, 403);
    }

    return admin.database().ref('tasks/'+uid+'/'+tid).set({
        title: title,
        descripcion: descripcion,
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

    return admin.database().ref('tasks/'+uid+'/'+tid).update({
        completed: true,
        completedDate: new Date().getTime()
    }).then(() => {
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

const adminTasks = (req, res) => {
    if (req.method !== 'GET') {
        return handleResponse(uid, 403);
    }

    let taskCount = {};
    taskCount.incompleted = 0;
    taskCount.completedOnDay = 0;
    taskCount.completedBeforeDay = 0;
    taskCount.completedAfeterDay = 0;
    taskCount.avaiable = 0;
    taskCount.avaiableToDay = 0;

    const toDay = new Date().getTime();
    const start = new Date();
    start.setHours(0,0,0,0);

    const end = new Date();
    end.setHours(23,59,59,999);

    return admin.database().ref('tasks').once('value').then((tasks) => {
        tasks.forEach((user) => {
            user.forEach((task) => {
                if (task.child('completed').val()) {
                    if (task.child('dueDate').val() <= task.child('completedDate').val()) {
                        taskCount.completedBeforeDay++;
                    } else {
                        taskCount.completedAfeterDay++;
                    }
                } else {
                    if (task.child('dueDate').val() < toDay) {
                        taskCount.incompleted++;
                    } else {
                        if (task.child('dueDate').val() >= start.getTime() && task.child('dueDate').val() <= end.getTime()) {
                            taskCount.avaiableToDay++;
                        } else {
                            taskCount.avaiable++;
                        }
                    }
                }
            });
        });
    }).then(() => {
        res.status(200);
        res.send(taskCount);
    }).catch(error => {
        res.status(404).json({ error: error }).end();
        console.log("Error creating new task:", error);
    });
};

app.get('/admin', adminTasks);
app.use('/new', newTask);
app.use('/edit', editTask);
app.use('/delete', deleteTask);
app.use('/complete', completeTask);
app.get('/dueToday', todayTasks);
app.get('/delayed', delayedTasks);
app.get('/all', allTasks);

exports.task = functions.https.onRequest(app);