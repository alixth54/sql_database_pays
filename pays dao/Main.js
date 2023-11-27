document.getElementById('selectcontinent').addEventListener("change",function() {
	document.getElementById('formfiltres').submit();
});

document.getElementById('selectregion').addEventListener("change",function() {
	document.getElementById('formfiltres').submit();
});

const table =$('#example').DataTable( {
    data: myData,
    // columns: [
    //     { data:$infoVille[0][0]},
    //     { data:$infoVille[0][1]},
    //     { data:$infoVille[0][2]},
    //     { data:$infoVille[0][3]},
    //     { data:$infoVille[0][4],
        
    //         render: function ( data, type, row ) {
    //             if (data==0) {
    //                 return '<span style="color:orange">'+data+'</span>';
    //             } else {
    //                 return '<span style="color:green">'+data+'</span>';
    //             }
                
    //             return data;
    //         }
    //     },
    //     { data:'agence.name'},
    //     { data:'kid.length'}
    // ]
    
} );