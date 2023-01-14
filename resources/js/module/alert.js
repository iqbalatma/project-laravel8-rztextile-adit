function alertQuantityNotEnough(){
  return Swal.fire({
    icon: 'error',
    title: 'Action cannot be done !',
    text: 'Item availability is not enough!',
  })
}


export {alertQuantityNotEnough}