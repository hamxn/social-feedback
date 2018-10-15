'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(UpdateStatusComplaint) {
  Composer.restrictModelMethods(UpdateStatusComplaint);
};
