Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire({
                icon: "success",
                title: "se cerro sesión correctamente"
            }).then(() => {
        // Limpia la URL sin recargar
        window.history.replaceState({}, document.title, window.location.pathname);
    });