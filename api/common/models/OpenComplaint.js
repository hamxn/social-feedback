'use strict';

const Composer = require('../lib/composer.js');

module.exports = function(OpenComplaint) {
  Composer.restrictModelMethods(OpenComplaint);
};
