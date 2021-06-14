import 'jquery';

$(function() {
    var $ordersCollectionHolder = $('ul.orders');
    $ordersCollectionHolder.data('index', $ordersCollectionHolder.find('input' ).length);
    $('body').on('click', '.add_order_link', (e)=>{
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        addFormToCollection($collectionHolderClass);
    })
})
function addFormToCollection($collectionHolderClass) {
    var $collectionHolder = $('.' + $collectionHolderClass);
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index);
    var $newFormLi = $('<li></li>').append(newForm);
    $collectionHolder.append($newFormLi);
}