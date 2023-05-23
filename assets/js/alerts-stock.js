function deleteProduct(id) {
    swal({
        title: "¿Desea eliminar este producto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                swal("El producto se eliminara", {
                    icon: "success",
                });                
            } else {
                swal("Acción cancelada");
            }
        });
}