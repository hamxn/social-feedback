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
    
    const complaintId =`${dataCreateIssue.getTime()}-${tx.issuerId}`
    let asset = factory.newResource('org.healthsystem', 'Complaint', complaintId)
    asset.title = tx.title
	asset.cityId  = tx.cityId
  	asset.prefectureId  = tx.prefectureId
  	asset.content = tx.content
    asset.address = tx.address  
    asset.imagePath = tx.imagePath
    asset.imageHash = tx.imageHash
    asset.issuerId = tx.issuerId	

    asset.complaintId = complaintId
    asset.dateCreateIssue = tx.dateCreateIssue
    asset.dateUpdateIssue = tx.dateCreateIssue
    asset.status = 0
    asset.type = "VSATTP"
    asset.resolvers = []      

    return getAssetRegistry('org.healthsystem.Complaint')
      .then(registry => registry.add(asset))     
   
}

 /* 
  const checkCanChange = (oldStatus, newStatus) => {
    switch (oldStatus) {
      case 'OPEN': return ['IN_PROGRESS', 'PENDING', 'REJECTED' ].includes(newStatus);
      case 'PENDING':  return ['IN_PROGRESS','REJECTED' ].includes(newStatus);
      case 'IN_PROGRESS':  return ['DONE' ].includes(newStatus);
      default: return false
    }
  }*/	
/**
 * Sample transaction processor function.
 * @param {org.healthsystem.UpdateStatusComplaint} tx The sample transaction instance.
 * @transaction
 */
async function changeStatusComplaint(tx) {  // eslint-disable-line no-unused-vars
  const resolver = await getParticipantRegistry('org.healthsystem.DepartmentOfHealth')
                       .then(registry => registry.get(tx.resolver.getIdentifier( )))  
  
  let complaint = await getAssetRegistry('org.healthsystem.Complaint')
  					   .then(registry => registry.get(tx.complaint.getIdentifier()))
  
  if(complaint.status != tx.status) {
    
    complaint.status = tx.status
    complaint.dateUpdateIssue = new Date()
    complaint.resolvers.push(resolver)
    
    return getAssetRegistry('org.healthsystem.Complaint')
      		.then(registry => registry.update(complaint))

  } else throw new Error(`Cant update status from ${complaint.status} to ${tx.status}`);
     
}
