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
    let dataCreateIssue = new Date()
    
    const issuer = await getParticipantRegistry('org.healthsystem.Citizen')
                       .then(registry => registry.get(tx.issuer.getIdentifier( )))
	console.log(issuer)
  
    if (issuer){
      const complaintId =`${dataCreateIssue.getTime()}-${issuer.getIdentifier( )}`
      let asset = factory.newResource('org.healthsystem', 'Complaint', complaintId)
      asset.title = tx.title
      asset.address = tx.address
      asset.text = tx.text
      asset.images = tx.images

      asset.complaintId = complaintId
      asset.dataCreateIssue = dataCreateIssue
      asset.status = "OPEN"
      asset.type = "VSATTP"
      asset.owner = issuer
      asset.resolvers = []      

      return getAssetRegistry('org.healthsystem.Complaint')
          .then(registry => registry.add(asset))
     }
   
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
