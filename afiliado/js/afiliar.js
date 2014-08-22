/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#datetimepicker').datetimepicker({
        weekStart: 1,
        language: 'es',
        pickDate: false, //en/disables the date picker
        pickTime: false,
        showToday: true,
        sideBySide: false,
        useMinutes: false, //en/disables the minutes picker
        useSeconds: false, //en/disables the seconds picker
        useCurrent: false
    });
    $(function() {

    });
});

