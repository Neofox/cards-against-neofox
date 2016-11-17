require('../../sass/layout.scss');

import ReactDOM from 'react-dom';
import React from 'react';

import GameList from '../containers/GameList';
import Index from '../containers/Index';
import {Router, Route, browserHistory} from 'react-router'

const routes = (
    <div>
        // set a base url to '/' or maybe '/app_dev.php'
        <Route path={window.baseUrl} component={Index}>
            <Route path={window.baseUrl + "login"} component={Login}/>
            <Route path={window.baseUrl + "register"} component={Register}/>
            <Route path={window.baseUrl + "profil"} component={Profil}/>
        </Route>
        <Route path={window.baseUrl} component={GameList}/>
    </div>
);


export default (props) => {
    var rprops = {};
    rprops.params = props;
    var createElement = function (Component, compProps) {
        for (var prop in props) {
            compProps.params[prop] = props[prop];
        }
        return <Component {...compProps} />
    };
    return (
        <Router createElement={createElement} history={browserHistory} children={routes} {...props}/>
    );
};
