'use strict';

/* global getAssetRegistry getParticipantRegistry getFactory */
/**
 * Sample transaction processor function.
 * @param {org.healthsystem.OpenComplaint} tx The sample transaction instance.
 * @return {org.healthsystem.Complaint} asset was created
 * @transaction
 */
async function openComplaint(tx) {  // eslint-disable-line no-unused-vars
    const factory = getFactory()
    let complaint = new Object()
    let dataCreateIssue = new Date.now()
    const getId = () => `${dataCreateIssue.getTime()}-${t.issuer.getIdentified()}`
      
    complaint.title = tx.title
    complaint.address = tx.address
    complaint.text = tx.text
    complaint.images = tx.images
    
    complaint.complaintId = getId()
    complaint.dataCreateIssue = dataCreateIssue
    complaint.status = status.OPEN
    complaint.type = ComplaintType.VSATTP
    complaint.owner = tx.issuer
    complaint.resolvers = []

    asset = factory.newResource('org.healthsystem', 'Complaint', complaint)

    return getAssetRegistry('org.healthsystem.Complaint')
        .then(registry =>  registry.add(asset))
      	.then( ()  =>  getAssetRegistry('org.healthsystem.Complaint'))
        .then(registry  =>  registry.get(tx.complaintId))
}

/**
 * Sample transaction processor function.
 * @param {org.healthsystem.UpdateStatusComplaint} tx The sample transaction instance.
 * @transaction
 */
async function changeStatusComplaint(tx) {  // eslint-disable-line no-unused-vars
    // --> Complaint complaint
    // --> DepartmentOfHealth resolver
    // o ComplaintStatus status
}
