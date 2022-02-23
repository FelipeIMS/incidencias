const tabla = document.querySelector("#tabla");
const datatable = new DataTable(tabla,{
    labels: {
        placeholder: "Buscar...",
        perPage: "{select} Incidencias por paginas",
        noRows: "No hay mas incidencias",
        info: "Mostrando {start} a {end} de {rows} incidencias",
    }
});

