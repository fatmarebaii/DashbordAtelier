// async function getProdLine(){
//     const response = await fetch ("http://localhost/digitex_isa/dashbord_atelier/index.php")
//     const data = await response.json()
// //     // console.log(data[0].prod_line)
// //     console.log(data)

//     document.querySelector("#PL").innerHTML = "<h1>" + data.prodline + "</h1>"
// }
// getProdLine()

async function getEngage() {
  const response = await fetch("http://localhost/digitex_isa/dashbord_atelier/ISA203/index.php");
  const data = await response.json();
  //console.log(data)
   //console.log(data.qengaged);
  // console.log(document.querySelector("#Qte"));

  document.querySelector("#Qte").innerHTML = "<h1>" + data.qengaged + "</h1>";
}
getEngage()

async function getEncours() {
  const response = await fetch("http://localhost/digitex_isa/dashbord_atelier/ISA203/index.php");
  const data = await response.json();
  // console.log(data);
  // console.log(data.qencours);
  // console.log(document.querySelector("#Encours"));
  document.querySelector("#Encours").innerHTML =
    "<h1>" + data.qencours + "</h1>";
}
getEncours()

async function getFab() {
  const response = await fetch("http://localhost/digitex_isa/dashbord_atelier/ISA203/index.php");
  const data = await response.json();
  document.querySelector("#fab").innerHTML = "<h1>" + data.qfab + "</h1>";
}
getFab()

async function getControl() {
  const response = await fetch("http://localhost/digitex_isa/dashbord_atelier/ISA203/index.php");
  const data = await response.json();
  document.querySelector("#cq").innerHTML = "<h1>" + data.cq + " % </h1>";


}
getControl()

async function getPerformance() {
  const response = await fetch("http://localhost/digitex_isa/dashbord_atelier/ISA203/index.php");
  const data = await response.json();
  document.querySelector("#perf").innerHTML =
    "<h1>" + data.performance + "</h1>";

}
getPerformance()
