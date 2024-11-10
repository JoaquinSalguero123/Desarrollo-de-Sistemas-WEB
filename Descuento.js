
function DayDiscount(){
    const Dia = new Date()
    const Hoy = Dia.getDay()
    const PalabraDia= ['Lunes','Miercoles','Viernes']

    const Descuentos = [1,3,5]

    for(x=0; x< Descuentos.length; x++){

        if(Hoy == Descuentos[x]){
            document.getElementById('Descuento').textContent = `Felicitaciones, Tienes un 15% de Descuento por ser ` + PalabraDia[x];
            break;
            
        }else{
            document.getElementById('Descuento').textContent = `No hay descuento ya que no es Lunes, Miercoles o Viernes`;
        }
    }
    
}



window.onload = function() {
    DayDiscount();
}






