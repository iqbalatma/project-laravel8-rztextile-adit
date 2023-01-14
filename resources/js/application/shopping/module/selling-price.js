import helper from "../../../module/helper";

function onClickSellingPrice(context){
  $(context).text(helper.formatRupiahToInt($(context).text()));
}

function onKeyPressSellingPrice(context, event){
  helper.preventEnter(context, event);
  helper.prenvetNonNumeric(event);
}

function onBlurSellingPrice(context){
  let row = $(context).closest("tr");

  let sellingPrice = $(row).find(".selling-price").text();
  let quantityUnit = parseInt($(row).find(".quantity-unit").text());

  let newSubTotal = sellingPrice * quantityUnit;

  $(row).find(".sub-total").text(helper.formatIntToRupiah(newSubTotal))
  $(row).find(".selling-price").text(helper.formatIntToRupiah(sellingPrice))
}

export default {
  getSellingPriceElement(sellingPrice){
    return $(`<td>`,{
      text: helper.formatIntToRupiah(sellingPrice),
      class: "text-nowrap selling-price",
      attr:{
        contenteditable:true
      },
      click: function(){
        onClickSellingPrice(this);
      },
      blur: function(){
        onBlurSellingPrice(this);
      },
      keypress: function(event){
        onKeyPressSellingPrice(this, event);
      },
    });
  },
}