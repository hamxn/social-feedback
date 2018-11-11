'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(Citizen) {
  Composer.restrictModelMethods(Citizen);
};
