#!/bin/python

import requests

# url = 'https://www.opentask.tech'
url = 'http://localhost/Sites/openTask/www'
checkLogin = '/checkLogin'
projectType = 'public'
projectAdd = '/project/add'
taskAdd = '/task/add'
cookies = []


class User:
    def __init__(self, name, pasw):
        self.name = name
        self.pasw = pasw

    def connect(self):
        session = requests.session()
        req = session.post(url + checkLogin, data={'name': self.name, 'password': self.pasw}, cookies=cookies)
        print(req.status_code)
        return session


class Controller:

    def __init__(self, user):
        self.session = user.connect()

    def addProject(self, project):
        pType = project.pType
        req = self.session.post(url + '/' + pType + projectAdd, data={'title': project.name})
        print('Project added') if req.status_code == 200 else self.errorHandler(req.status_code)

    def addTask(self, task):
        req = requests.post(url + taskAdd,
                            data={'projectId': task.projectId,
                                  'title': task.title,
                                  'descr': task.descr,
                                  'priority': task.prio,
                                  'maxDate': task.maxDate,
                                  'extLink': task.extLink})
        print('Task added') if req.status_code == 200 else self.errorHandler(req.status_code)

    def errorHandler(self, code):
        if(code == 401):
            raise PermissionError('Access denied')
        elif(code == 404):
            raise Exception('Page not found')


class Project:
    def __init__(self, pType, name):
        self.pType = pType
        self.name = name


class Task:
    def __init__(self, projectId, title, descr, prio, maxDate, extLink):
        self.projectId = projectId
        self.title = title
        self.descr = descr
        self.prio = prio
        self.maxDate = maxDate
        self.extLink = extLink


u = User('phineas', 'Labo_g33k')
p = Project('public', 'test python priv')
t = Task(50, 'test tache py', 'description', 1, '', '')

ctrlr = Controller(u)
# ctrlr.addProject(p)
ctrlr.addTask(t)
