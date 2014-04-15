/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 4/14/14
 * Time: 3:51 PM
 * To change this template use File | Settings | File Templates.
 */

console.log("hello");

// Make an ajax call - this should give us the information needed on the unit id
var pfdInfo = location.pathname.split("/");
console.log(pfdInfo[pfdInfo.length-1]);

function getData() {
    // Supposed to be an AJAX call to request information about the drawing
}

function drawReactor() {

    // Draw Reactor
    context.beginPath();
    context.arc(50,50,25,Math.PI,0);
    context.stroke();

    context.beginPath();
    context.arc(50,100,25,0,Math.PI);
    context.stroke();

    context.beginPath();
    context.rect(25,50,50,50);
    context.stroke();

    context.beginPath();
    context.moveTo(25,50);
    context.lineTo(75,100);
    context.stroke();

    context.beginPath();
    context.moveTo(75,50);
    context.lineTo(25,100);
    context.stroke();

}

function drawColumn() {
    //Draw Column
    context.beginPath();
    context.arc(125,25,10,Math.PI,0);
    context.stroke();

    context.beginPath();
    context.rect(115,25,20,40);
    context.stroke();

    context.beginPath();
    context.moveTo(115,65);
    context.lineTo(110,75);
    context.stroke();

    context.beginPath();
    context.moveTo(135,65);
    context.lineTo(140,75);
    context.stroke();

    context.beginPath();
    context.rect(110,75,30,40);
    context.stroke();

    context.beginPath();
    context.arc(125,115,15,0,Math.PI);
    context.stroke();
}

function drawFurnace() {

}


// Draw the piece of equipment:

// If a reactor

// If a column

// If a furnace

$(document).ready(function() {

    getData();


    unit = document.getElementById('unit');
    context = unit.getContext('2d');

    context.font = "30px Garamond";
    context.lineWidth = 2;

    drawReactor();
    drawColumn();
});