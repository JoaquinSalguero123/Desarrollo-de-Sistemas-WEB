

function displayCurrentDate() {
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    };
    document.getElementById('currentDate').textContent = `Hoy es ${now.toLocaleDateString('es-ES', options)}`;
}





window.onload = function() {
    displayCurrentDate();
}



