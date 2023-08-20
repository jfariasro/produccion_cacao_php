
function Grafica(dato, titulo, id) {
    google.charts.load("current", {
        "packages": ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var datos = google.visualization.arrayToDataTable(dato);
        var opcciones = {
            title: titulo
        };
        var chart = new google.visualization.ColumnChart(document.getElementById(id));
        chart.draw(datos, opcciones);
    }

}

/*

function getColor(valorv, valorc) {
    if (valorv < valorc) {
        return 'rgba(255, 0, 0, 1)'; // Rojo
    } else if (valorv == valorc) {
        return 'rgba(255, 255, 0, 1)'; // Amarillo
    } else {
        return 'rgba(0, 0, 255, 1)'; // Azul
    }
}
*/

function Graficar(dato) {
    let colores = [];
    let venta = [];
    let prediccion = [];
    let meses = [];

    console.log(dato[1][1]);
    
    for (var i = 1; i < dato.length; i++) {
        meses.push(dato[i][0]);
        venta.push(dato[i][1]);
        prediccion.push(dato[i][2]);

        //var color = getColor(venta[i - 1], prediccion[i - 1]);
        //colores.push(color);
    }

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ventas',
                    data: venta,
                    backgroundColor: 'rgba(0, 0, 255, 1)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 1
                },
                    {
                        label: 'Predicción',
                        data: prediccion,
                        backgroundColor: 'rgba(255, 0, 0, 1)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'black'
                        }
                    }]
                }
            }
    });


}

