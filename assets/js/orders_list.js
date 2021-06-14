const List = require("list.js");

var options = {
    valueNames: [
        'customer',
        'orders',
        'description',
        'date',
        'status'
    ]
};

var ordersList = new List('ordersLists', options);

$(()=>{
    $('body').on('click','.show-draft',(e)=>{
        ordersList.search('draft');
    });
    $('body').on('click','.show-designing',(e)=>{
        ordersList.search('designing');
    });
    $('body').on('click','.show-printing',(e)=>{
        ordersList.search('printing');
    });
    $('body').on('click','.show-delivering',(e)=>{
        ordersList.search('delivering');
    });
})