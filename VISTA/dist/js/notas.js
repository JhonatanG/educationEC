var totalF=0;


totalF=document.getElementById("num").value;


function sumarPromedioQ1(valor){

   // var PromedioQ1 = 0;
    //alert(totalF);
  // valor = parseInt(valor);
   // var j = 0;
    for (var i=1; i<=totalF;i++){
   // PromedioQ1=document.getElementById("Q1"+i).value;
   var P1=0, P2=0, T=0,P3=0,EX=0;
   P1=document.getElementById("P1Q1"+i).value;
   P2=document.getElementById("P2Q1"+i).value;
  P3=document.getElementById("P3Q1"+i).value;
  EX=document.getElementById("ExQ1"+i).value;

   //alert(P);
   T=((parseFloat(P1)+parseFloat(P2)+parseFloat(P3)+parseFloat(EX))/4);
   T=T.toFixed(2);
   //alert(T);
   document.getElementById("Q1"+i).value=T;
   T="";
   
   //alert(valor);
   //PromedioQ1 = (PromedioQ1 == null || PromedioQ1 == undefined || PromedioQ1 == "") ? 0 : PromedioQ1;
   //PromedioQ1 = (parseInt(PromedioQ1) + parseInt(valor));
     // j = i;
    }
  
}

function sumarPromedioQ2(valor){

  // var PromedioQ1 = 0;
   //alert(totalF);
 // valor = parseInt(valor);
  // var j = 0;
   for (var i=1; i<=totalF;i++){
  // PromedioQ1=document.getElementById("Q1"+i).value;
  var P1Q2=0, P2Q2=0, TQ2=0,P3Q2=0,EXQ2=0, PRQ1=0, PRQ2=0, TPR=0;
  P1Q2=document.getElementById("P1Q2"+i).value;
  P2Q2=document.getElementById("P2Q2"+i).value;
 P3Q2=document.getElementById("P3Q2"+i).value;
 EXQ2=document.getElementById("ExQ2"+i).value;

  //alert(P);
  TQ2=((parseFloat(P1Q2)+parseFloat(P2Q2)+parseFloat(P3Q2)+parseFloat(EXQ2))/4);
  TQ2=TQ2.toFixed(2);
  //alert(T);
  document.getElementById("Q2"+i).value=TQ2;
  TQ2="";
  PRQ1= document.getElementById("Q1"+i).value;
  PRQ2= document.getElementById("Q2"+i).value;
  TPR=((parseFloat(PRQ1)+parseFloat(PRQ2))/2);
  TPR=TPR.toFixed(2);
  document.getElementById("P"+i).value=TPR;
 TPR="";
  
  //alert(valor);
  //PromedioQ1 = (PromedioQ1 == null || PromedioQ1 == undefined || PromedioQ1 == "") ? 0 : PromedioQ1;
  //PromedioQ1 = (parseInt(PromedioQ1) + parseInt(valor));
    // j = i;
   }
 
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type=number]').forEach( node => node.addEventListener('keypress', e => {
    if(e.keyCode == 13) {
      e.preventDefault();
    }
  }))
});