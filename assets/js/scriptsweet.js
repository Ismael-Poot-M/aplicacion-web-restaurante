/* =========================
   TOAST GLOBAL (SweetAlert2)
========================= */
const Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

/* =========================
   DRAG & DROP
========================= */
let objetos = document.querySelectorAll('.objeto');

objetos.forEach(obj => {
    obj.addEventListener('mousedown', e => {

        let offsetX = e.clientX - obj.offsetLeft;
        let offsetY = e.clientY - obj.offsetTop;

        const mover = ev => {
            obj.style.left = (ev.clientX - offsetX) + 'px';
            obj.style.top = (ev.clientY - offsetY) + 'px';
        };

        const soltar = () => {
            document.removeEventListener('mousemove', mover);
            document.removeEventListener('mouseup', soltar);
        };

        document.addEventListener('mousemove', mover);
        document.addEventListener('mouseup', soltar);
    });
});

/* =========================
   RESIZE SOLO MUEBLES
========================= */
let muebles = document.querySelectorAll('.resizable');

muebles.forEach(m => {
    m.addEventListener('dblclick', () => {

        let img = m.querySelector('img');

        let nuevoWidth = prompt("Ancho en px:", img.width);
        let nuevoHeight = prompt("Alto en px:", img.height);

        if (nuevoWidth && nuevoHeight) {
            img.style.width = nuevoWidth + 'px';
            img.style.height = nuevoHeight + 'px';
        }

    });
});

/* =========================
   GUARDAR MAPA
========================= */
document.getElementById('guardarPosiciones').addEventListener('click', () => {

    let datos = [];

    objetos.forEach(o => {

        let img = o.querySelector('img');

        datos.push({
            id: o.dataset.id,
            type: o.dataset.type,
            x: parseInt(o.style.left) || 0,
            y: parseInt(o.style.top) || 0,
            width: img.width,
            height: img.height
        });
    });

    /* VALIDACIÓN BÁSICA */
    if (datos.length === 0) {
        Toast.fire({
            icon: "warning",
            title: "No hay elementos para guardar"
        });
        return;
    }

    /* TOAST INFO */
    Toast.fire({
        icon: "info",
        title: "Guardando mapa..."
    });

    fetch('guardar_posiciones_admin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(response => {

        if (response.status === 'success') {

            Toast.fire({
                icon: "success",
                title: response.message
            });

        } else {

            Toast.fire({
                icon: "error",
                title: response.message
            });

        }

    })
    .catch(err => {

        Toast.fire({
            icon: "error",
            title: "Error de red"
        });

        console.error(err);
    });

});