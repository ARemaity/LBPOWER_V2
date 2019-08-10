var uid;

firebase.auth().onAuthStateChanged(function(user) {
    var user = firebase.auth().currentUser;
    

     if(user != null){ 
              document.getElementById("myPlot").style.display = "block";//..this to show the elemet
     document.getElementById("alert").style.display = "none";//..THIS FOR TO hide the elemnet
       uid=user.uid;
       var root="Time_"+uid;
//window.alert(root);
var nbOfElts= 300;  
firebase.database().ref(root).limitToLast(nbOfElts).on('value', ts_measures => {
    let timestamps = [];
    let values = [];
    ts_measures.forEach(ts_measure => {
        //console.log(ts_measure.val().timestamp, ts_measure.val().value);
        timestamps.push(moment(ts_measure.val().timestamp).format('YYYY-MM-DD HH:mm:ss'));
        values.push(ts_measure.val().value);
    });

  
    myPlotDiv = document.getElementById('myPlot');

 
    const data = [{
        x: timestamps,
        y: values
    }];

    const layout = {
        title: '<b>electricity consumption live </b>',
        titlefont: {
            family: 'Courier New, monospace',
            size: 16,
            color: '#000'
        },
        xaxis: {
            linecolor: 'black',
            linewidth: 2
        },
        yaxis: {
            title: '<b>kw/h</b>',
            titlefont: {
                family: 'Courier New, monospace',
                size: 14,
                color: '#000'
            },
            linecolor: 'black',
            linewidth: 2,
        },
        margin: {
            r: 50,
            pad: 0
        }
    }
    // At last we plot data :-)
    Plotly.newPlot(myPlotDiv, data, layout, { responsive: true });
});


      //     window.alert("graph id is "+uid);
     
       
   } else {
    document.getElementById("alert").style.display = "block";//..this to show the elemet
    document.getElementById("myPlot").style.display = "none";//..THIS FOR TO hide the elemnet
   }
 });
