'use strict';

/**
 * Sample transaction processor function.
 * @param {org.healthsystem.OpenComplaint} tx The sample transaction instance.
 * @return {org.healthsystem.Complaint} asset was created
 * @transaction
 */
async function openComplaint(tx) {  // eslint-disable-line no-unused-vars
    const factory = getFactory()    
    let asset = factory.newResource('org.healthsystem', 'Complaint', tx.complaintId)
    asset.title = tx.title
  	asset.prefectureId  = tx.prefectureId
  	asset.content = tx.content
    asset.address = tx.address  
    asset.imagePath = tx.imagePath
    asset.imageHash = tx.imageHash
    asset.issuerId = tx.issuerId	

    asset.complaintId = tx.complaintId
    asset.dateCreateIssue = tx.dateCreateIssue
    asset.dateUpdateIssue = tx.dateCreateIssue
    asset.status = 0
    asset.type = "VSATTP"
    asset.resolvers = []      

    return getAssetRegistry('org.healthsystem.Complaint')
      .then(registry => registry.add(asset))     
   
}

/**
 * Sample transaction processor function.
 * @param {org.healthsystem.UpdateStatusComplaint} tx The sample transaction instance.
 * @transaction
 */
async function changeStatusComplaint(tx) {
  let complaint = await getAssetRegistry('org.healthsystem.Complaint')
  					   .then(registry => registry.get(tx.complaintId))
  
  if(complaint.status != tx.status) {
    
    complaint.status = tx.status
    complaint.dateUpdateIssue = new Date()
    complaint.resolvers.push(tx.resolver)
    
    return getAssetRegistry('org.healthsystem.Complaint')
      		.then(registry => registry.update(complaint))

  } else throw new Error(`Cant update status from ${complaint.status} to ${tx.status}`);
     
}
