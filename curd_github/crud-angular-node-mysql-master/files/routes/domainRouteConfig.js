/* Route, Render */
//productCategoryRouteConfiguration.js
var fileDao = '../Server/Dao/domainDao.js';

function domainRouteConfig(app) {
    this.app = app;
    this.routeTable = [];
    this.init();
}

domainRouteConfig.prototype.init = function () {
    var self = this;
    this.addRoutes();
    this.processRoutes();
}

domainRouteConfig.prototype.processRoutes = function () {
    var self = this;
    
    self.routeTable.forEach(function (route) {
        if (route.requestType == 'get') {
            // console.log(route);
            self.app.get(route.requestUrl, route.callbackFunction);
        }
        else if (route.requestType == 'post') {         
            // console.log(route);
            self.app.post(route.requestUrl, route.callbackFunction);
        }
        else if (route.requestType == 'delete') {         
            // console.log(route);
            self.app.delete(route.requestUrl, route.callbackFunction);
        }
    });
}

domainRouteConfig.prototype.addRoutes = function () {
    var self = this;
    
    //createDomain
    self.routeTable.push({
        requestType : 'get',
        requestUrl : '/createDomain',
        callbackFunction: function (request, response) {
            response.render('domain/createDomain', { title: "Create Domain" });
        }
    });

    //api/createDomain
    self.routeTable.push({
        requestType : 'post',
        requestUrl : '/api/createDomain',//api
        callbackFunction : function (request, response) {
            var domainDao = require(fileDao);

            //console.log(request.body);

            domainDao.domainDao.createDomain(request.body,
                function (status) {
                    response.json(status);
                    // console.log(status);
                });
        }
    });

    //viewDomain
    self.routeTable.push({
        requestType : 'get',
        requestUrl : '/viewDomain',
        callbackFunction : function (request, response) {
            response.render('domain/viewDomain', { title: "View Domain" });
        }
    });

    //viewDomain By Id
    self.routeTable.push({
        requestType : 'get',
        requestUrl : '/viewDomain/:domain_id',
        callbackFunction : function (request, response) {
            response.render('domain/viewDomainById', { title: "View Domain" });
        }
    });

    //api/getAllDomain
    self.routeTable.push({
        requestType : 'get',
        requestUrl : '/api/getAllDomain',//api - fine
        callbackFunction : function (request, response) {
            var domainDao = require(fileDao);

            domainDao.domainDao.getAllDomain (
                function (domainArr) {
                    // console.log(domainArr);
                    response.json({ domainArr : domainArr });
                });
        }
    });

    //editDomain
    self.routeTable.push({
        requestType: 'get',
        requestUrl: '/editDomain/:domain_id',
        callbackFunction: function (request, response) {
            response.render('domain/editDomain', {title: "Edit Domain"});
        }
    });

    //api/getDomainById
    self.routeTable.push({
        requestType : 'get',
        requestUrl : '/api/getDomainById/:domain_id',//api
        callbackFunction : function (request, response) {
            var domainDao = require(fileDao);

            domainDao.domainDao.getDomainById(request.params.domain_id,
                function (domainArr) {
                    // console.log(domainArr);
                    response.json({ domainArr : domainArr });
            });
        }
    });

    //api/updateDomain
    self.routeTable.push({
        requestType: 'post',
        requestUrl: '/api/updateDomain',//api
        callbackFunction: function (request, response) {
            /*console.log('Name-'+request.body.categoryName);
            console.log('Detail-'+request.body.details);//server side programming
            */

            var domainDao = require(fileDao);
            domainDao.domainDao.updateDomain(request.body.domain_name, request.body.hosting, request.body.hosting_date, request.body.expiry_date, request.body.domain_id,
                function (status) {
                    // console.log(status);
                    response.json(status);
            });
        }
    });

    self.routeTable.push({
        requestType: 'delete',
        requestUrl: '/api/deleteDomainById/:domain_id',//api
        callbackFunction: function (request, response) {
            // console.log(request.params.domain_id);

            var domainDao = require(fileDao);
            domainDao.domainDao.deleteDomainById(request.params.domain_id,
                function (status) {
                    // console.log(status);
                    response.json(status);
                });
        }
    });
}

module.exports = domainRouteConfig;