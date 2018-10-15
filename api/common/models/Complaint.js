'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(Complaint) {
  Composer.restrictModelMethods(Complaint);
};
