'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(DepartmentOfHealth) {
  Composer.restrictModelMethods(DepartmentOfHealth);
};
