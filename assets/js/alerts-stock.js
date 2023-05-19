function deleteProduct(id) {
    swal({
        title: "¿Desea eliminar este producto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("El prodiucto se eliminara", {
                    icon: "success",
                });
            } else {
                swal("Acción cancelada");
            }
        });
}


function updateProduct(id) {
    swal({
        title: "¿Desea editar este producto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("El producto se modifico satisfactoriamente", {
                    icon: "success",
                });
            } else {
                swal("Acción cancelada");
            }
        });
}