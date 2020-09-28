/**
 * Created by jose on 18/10/2019.
 */
jQuery.event.special.touchstart =
    {
        setup: function (_, ns, handle) {
            if (ns.includes("noPreventDefault")) {
                this.addEventListener("touchstart", handle, {passive: false});
            }
            else {
                this.addEventListener("touchstart", handle, {passive: true});
            }
        }
    };
$('#fecha_nacimiento').daterangepicker({
    timeZone: null,
    singleDatePicker: true,
    showDropdowns: true,
    startDate: moment().subtract(18, 'years'),
    maxDate: moment().subtract(18, 'years'),
    minDate: moment().subtract(70, 'years'),
    locale: {
        format: 'YYYY-MM-DD',
        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    },
});

var idBajar = [1, 2, 3, 4, 5];
var idMusculo = [7, 8, 9, 10, 11];
var etiqueta = ["muy lento", "lento", "normal", "rapido", "muy rapido"];

$('#musculo').ionRangeSlider({
    skin: "round",
    type: "single",
    grid: true,
    values: idMusculo,
    prettify: function (n) {
        var ind = idMusculo.indexOf(n);
        return etiqueta[ind];
    }
});

$('#bajar').ionRangeSlider({
    skin: "round",
    type: "single",
    grid: true,
    values: idBajar,
    prettify: function (n) {
        var ind = idBajar.indexOf(n);
        return etiqueta[ind];
    }
});