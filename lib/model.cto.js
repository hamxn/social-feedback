'use strict';

/* global getAssetRegistry getParticipantRegistry getFactory */
/**
 * Sample transaction processor function.
 * @param {org.healthsystem.OpenComplaint} tx The sample transaction instance.
 * @transaction
 */
async function openComplaint(tx) {  // eslint-disable-line no-unused-vars
    console.log('processing in ope complaint');
   
}

/**
 * Sample transaction processor function.
 * @param {org.healthsystem.UpdateStatusComplaint} tx The sample transaction instance.
 * @transaction
 */
async function changeStatusComplaint(tx) {  // eslint-disable-line no-unused-vars
    console.log('processing on change status');
}
