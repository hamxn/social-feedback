'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(MinistryOfHealth) {
  Composer.restrictModelMethods(MinistryOfHealth);
};
