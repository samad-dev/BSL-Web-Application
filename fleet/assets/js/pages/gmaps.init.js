var map; $(document).ready(function () {
    (map =
         new GMaps({
             div: "#gmaps-markers1",
            lat: -12.043333,
            lng: -77.028333
         })).addMarker({ 
            lat: -12.043333, lng: -77.03, 
            title: "Lima", 
            details: 
            { 
                database_id: 42, 
                author: "HPNeo" },
                click: function (a) {
                    console.log && console.log(a),
                    alert("You clicked in this marker") 
                } 
            })
                    
                    });