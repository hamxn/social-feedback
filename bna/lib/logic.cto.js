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
                       .then(registry => registry.get(tx.issuer.getIdentifier()))
    
    const complaintId =`${dataCreateIssue.getTime()}-${issuer.getIdentifier()}`
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

/**
 *  Will update by document
 * logic:   
 * // Will update by document
 * // o OPEN  o PENDDING  o INGROGRESS  o REJECTED  o DONE
 * // 1)_ OPEN => INGROGRESS, PENDING, REJECTED
 * // 2)_ PENDDING => INGROGRESS, REJECTED
 * // 3)_ INGROGRESS => DONE
 * @param {org.healthsystem.StatusComplaint} oldStatus 
 * @param {org.healthsystem.StatusComplaint} newStatus 
 * @result boolean
 */
  const checkCanChange = (oldStatus, newStatus) => {
    switch (oldStatus) {
      case 'OPEN': return ['IN_PROGRESS', 'PENDING', 'REJECTED' ].includes(newStatus);
      case 'PENDING':  return ['IN_PROGRESS','REJECTED' ].includes(newStatus);
      case 'IN_PROGRESS':  return ['DONE' ].includes(newStatus);
      default: return false
    }
  }	

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

  const oldStatus = complaint.status
  const isChange = checkCanChange(oldStatus, tx.status)

  if (isChange) {

    complaint.status = tx.status
    complaint.resolvers.push(resolver)
    
    return getAssetRegistry('org.healthsystem.Complaint')
      		.then(registry => registry.update(complaint))

  } else throw new Error(`Cant update status from ${oldStatus} to ${tx.status}`);
     
}
