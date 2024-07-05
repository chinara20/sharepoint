'use strict';

const express = require('express');
const https = require('https');
const socketio = require('socket.io');
const socketEvents = require('./utils/socket');

class Server {
    constructor() {
        this.port = process.env.PORT || 3000;
        this.host = process.env.HOST || `10.2.252.3`;

        this.app = express();
        this.https = https.Server(this.app);
        this.socket = socketio(this.https);
    }

    appRun(){
        new socketEvents(this.socket).socketConfig();
        this.app.use(express.static(__dirname + '/uploads'));
            this.app.use(function (req, res, next) {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
    res.setHeader('Access-Control-Allow-Credentials', true);
    next();});
        this.https.listen(this.port, this.host, () => {
            console.log(`Listening on https://${this.host}:${this.port}`);
        });
    }
}

const app = new Server();
app.appRun();