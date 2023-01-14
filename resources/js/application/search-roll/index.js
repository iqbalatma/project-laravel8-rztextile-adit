import helper from "../../module/helper";


$(document).ready(function(){

  /**
   * Description : selectize option configuration
   */
  const selectizeOption = {
    create: false,
    sortField: "text",
    openOnFocus: false,
    render: {
        option: function(data, escape) {
            return `<div class="item-roll-selectized"
                        data-id="${escape(data.data.id)}"
                        data-data="${escape(JSON.stringify(data.data))}">
                        ${escape(data.text)}
                    </div>`
        }
    },
    onChange: function(value) {
      onChangeSelectize(value)
    }
  }
    /**
   * Description : use to clear and always focus on selectize
   * 
   * @param {object} selectized initialize of selectize
   */
  function selectizedFocusAndClear(selectized) {
    selectized =  selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function(value) {
        onChangeSelectize(value);
    });
  }



  let selectized = $("#select-roll").selectize(selectizeOption);
  selectizedFocusAndClear(selectized);


  /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
     function onChangeSelectize(value) {
      const rollId = value;
      const dataSet =$(`.item-roll-selectized[data-id="${rollId}"]`).data("data"); 
  
      selectizedFocusAndClear(selectized);

      $.ajax({
        url: "/ajax/search-roll/"+rollId,
        context: document.body,
        method: "GET"
      }).done(function (response) {
        if(response.status == 200){
          console.log(response);
          console.log(response.data.created_at);
          const data = response.data;
          $("#roll-name").text(data.name)
          $("#roll-code").text(data.code)
          $("#roll-quantity-roll").text(data.quantity_roll)
          $("#roll-quantity-unit").text(data.quantity_unit + " " + data.unit.name)
          $("#roll-qrcode").text(data.qrcode)
          $("#roll-basic-price").text(helper.formatIntToRupiah(data.basic_price))
          $("#roll-selling-price").text(helper.formatIntToRupiah(data.selling_price))
          $("#roll-last-update").text(data.updated_at)

          let timerInterval
          return Swal.fire({
            title: 'Roll found !',
            text: `Search roll ${data.name} successfully !`,
            timer: 1500,
            icon:"success"
          });
        }
      }).fail(function (response) {
        console.log(response);
      });
    }
});