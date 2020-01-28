$(document).ready(function(){
  $("#searchCatalogo").on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const params = {
      code: $('#code').val(),
      description: $('#description').val(),
      clasification: $('#clasification').val(),
      tipo: $('#tipo').val(),
    }
    filter(params);
  })
  $('#productTable').on('click', ' tbody tr', function(e) {
    e.preventDefault();
    e.stopPropagation();
    const id = $(this)[0]['cells'][0].innerText;
    findOne(id);
    getUnidadMedida(id);
    findSonId(id);
    getNutricional(id);
  })
  $('#create-son-product').on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const code = $("#edt-code").val()
    if (code) {
      createSon();
    } else {
      alert("Seleccione una mercancia");
    }
  })
  $('#edt-son-product').on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const code = $("#edt-code").val()
    if (code) {
      update();
    } else {
      alert("Seleccione una mercancia");
    }
  })
  $("#info-nutricional").on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    updateNutricional();
  })
  $('#catalogoTable').on('mousedown', 'td button.btn-edit', function (event) {

    let code = $(this).parents("tr").attr('data-code');
    let factor_multi = $(this).parents("tr").attr('data-factor_multi');
    let factor_div = $(this).parents("tr").attr('data-factor_div');
    let tipo = $(this).parents("tr").attr('data-tipo');
    let estado = $(this).parents("tr").attr('data-estado');

    $(this).parents("tr").find("td:eq(1)").html('<input style="width:70px" class="form-control" name="code" value="'+code+'" >');
    $(this).parents("tr").find("td:eq(3)").html('<input style="width:70px" class="form-control" name="factor_multi" value="'+factor_multi+'">');
    $(this).parents("tr").find("td:eq(4)").html('<input style="width:70px" class="form-control" name="factor_div" value="'+factor_div+'">');
    $(this).parents("tr").find("td:eq(5)").html(setCatalogoTipo(tipo));
    $(this).parents("tr").find("td:eq(6)").html(setCatalogoEstado(estado));
    $(this).parents("tr").find("td:eq(9)").prepend("<button class='btn btn-info btn-xs btn-update'>Guardar</button><button class='btn btn-warning btn-xs btn-cancel'>Cancelar</button>")
    $(this).hide();
  });
  $("#catalogoTable").on("click", ".btn-cancel", function(){
      let code = $(this).parents("tr").attr('data-code');
      let factor_multi = $(this).parents("tr").attr('data-factor_multi');
      let factor_div = $(this).parents("tr").attr('data-factor_div');
      let tipo = $(this).parents("tr").attr('data-tipo');
      let estado = $(this).parents("tr").attr('data-estado');

      $(this).parents("tr").find("td:eq(1)").text(code);
      $(this).parents("tr").find("td:eq(3)").text(factor_multi);
      $(this).parents("tr").find("td:eq(4)").text(factor_div);
      $(this).parents("tr").find("td:eq(5)").text(tipo);
      $(this).parents("tr").find("td:eq(6)").text(estado);

      $(this).parents("tr").find(".btn-edit").show();
      $(this).parents("tr").find(".btn-update").remove();
      $(this).parents("tr").find(".btn-cancel").remove();
  });
  $("#catalogoTable").on("click", ".btn-update", function(){
      var code = $(this).parents("tr").find("input[name='code']").val();
      var factor_multi = $(this).parents("tr").find("input[name='factor_multi']").val();
      var factor_div = $(this).parents("tr").find("input[name='factor_div']").val();
      var tipo = $(this).parents("tr").find("select[name='tipo']").val();
      var estado = $(this).parents("tr").find("select[name='estado']").val();

      $(this).parents("tr").find("td:eq(1)").text(code);
      $(this).parents("tr").find("td:eq(3)").text(factor_multi);
      $(this).parents("tr").find("td:eq(4)").text(factor_div);
      $(this).parents("tr").find("td:eq(5)").text(tipo == 1 ? 'POR CAJA': "FACTORIZADO");
      $(this).parents("tr").find("td:eq(6)").text(estado == 1 ? 'SI': "NO");

      $(this).parents("tr").attr('data-code', code);
      $(this).parents("tr").attr('data-factor_multi', factor_multi);
      $(this).parents("tr").attr('data-factor_div', factor_div);
      $(this).parents("tr").attr('data-tipo', tipo);
      $(this).parents("tr").attr('data-estado', estado);

      $(this).parents("tr").find(".btn-edit").show();
      $(this).parents("tr").find(".btn-cancel").remove();
      $(this).parents("tr").find(".btn-update").remove();

      updateProduct({ code: code, factor_multi: factor_multi, factor_div: factor_div, tipo: tipo, estado: estado, _token: $("meta[name='csrf-token']").attr("content") });
  });
  function filter(params) {
    $.ajax({
      type: 'GET',
      data: params,
      url: '/productos/filter'
    }).then((data) => {
      const html = setProducto(data.data);
      $('#productTable tbody').empty().append(html);
    })
  }
  function setProducto(data) {
    let array = [];
    for (let i = 0; i < data.length; i++) {
      array[i] = `<tr>
                    <td style='padding: 0.5rem;white-space: pre-line;text-align: center;'>${data[i].CODI_RCODIGO}</td>
                    <td style='padding: 0.5rem;white-space: pre-line;'>${data[i].CODI_RNOMBRE}</td>
                  </tr>`;
    }
    return array;
  }
  async function setCatalogo(data){
    let array = [];
    array[0] = `<tr>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Padre</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Codigo</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Producto</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Multipl.</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Divisor</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Tipo</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Estado</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Usuario</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>Fecha</th>
                  <th style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'></th>
                </tr>`
    for (let i = 0; i < data.length; i++) {
      let params = await findName(data[i].CODI_RCODIGO);
      if (i >= 1) {
        array[i] = `<tr id='${data[i].CODI_RCODIGO}' data-factor_multi='${data[i].factor_multi}' data-tipo='${data[i].tipo}'
                        data-factor_div='${data[i].factor_div}' data-estado='${data[i].ESTADO}' data-code='${data[i].CODI_RCODIGO}'>

                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].CODI_PADRE}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].CODI_RCODIGO}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${params[0].CODI_RNOMBRE}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].factor_multi}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].factor_div}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].tipo == 1 ? "POR CAJA" : "FACTORIZADO"}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${data[i].ESTADO == 1 ? "SI" : "NO"}</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${ data[i].USUARIO ? data[i].USUARIO : "-" }</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>${ data[i].FECHA_REG ? data[i].FECHA_REG  : "-" }</td>
                      <td style='padding-right: 1rem;padding-left: 1rem;white-space: pre-line;'>
                        <button class="btn btn-info btn-edit"   data-id='${data[i].CODI_RCODIGO}'>
                          <div>
                            <i class="ni ni-ruler-pencil"></i>
                          </div>
                        </button>
                      </td>
                  </tr>`;
      }



    }
    return array;
  }
  function findName(id) {
     return $.ajax({
          type:'GET',
          url:'/productos/findOne',
          data: {id: id},
      });
  }
  function findOne(id){
    $.ajax({
      type:'GET',
      url:'/productos/findOne',
      data: {id: id}
    }).then((data) => {
      localStorage.setItem('mercancia', JSON.stringify(data[0]));
      getClasificacion();
      getClasificacion2();
      $('#edt-code').val(data[0].CODI_RCODIGO)
      $('#edt-name').val(data[0].CODI_RNOMBRE)
      $('#edt-unid-media').val(data[0].CODI_RCODIGO)
      $('#edt-multi-unid').val(data[0].TUME_MULT)
      $('#edt-tipo-code').val(data[0].TPCO_CODIGO)
      $('#edt-descripcion').val(data[0].CODI_RDESCRIP)
      $('#edt-peso').val(data[0].CODI_PESO)
      $('#edt-afecto-adicional').val(data[0].CODI_RAFECTO5)
      $('#edt-impuesto').val(data[0].IMP_ADICIONAL)
      $('#edt-code-arancelario').val(data[0].codi_arancelario)
      $('#edt-mayorista').val(data[0].prod_mayor)
      $('#edt-state').val(data[0].estado)
    })
  }
  function findSonId(id) {
    $.ajax({
      type:'GET',
      url:'/productos/catalogo',
      data: {id: id}
    }).then((data) => {
      //const html = setCatalogo(data);
       setCatalogo(data).then(function(html) {
          $('#catalogoTable thead').empty().append(html);
      })
    })
  }
  function createSon() {
    let current = JSON.parse(localStorage.getItem('mercancia'));
    const data = {
        CODI_PADRE: current.CODI_PADRE,
        CODI_RCODIGO: $('#create-code').val(),
        CODI_RNOMBRE: $('#create-name').val(),
        TUME_CODIGO: $('#create-unid-media').val(),
        TUME_MULT: $('#create-multi-unid').val(),
        TPCO_CODIGO: $('#create-tipo-code').val(),
        CODI_RDESCRIP: $('#create-descripcion').val(),
        CODI_PESO: $('#create-peso').val(),
        CODI_RAFECTO5: $('#create-afecto-adicional').val(),
        IMP_ADICIONAL: $('#create-impuesto').val(),
        codi_arancelario: $('#create-code-arancelario').val(),
        clco_codigo: $('#create-clasificacion-producto').val(),
        clco_codigo2: $('#create-clasificacion-mercancia').val(),
        prod_mayor: $('#create-mayorista').val(),
        estado: $('#create-state').val(),
        _token: $("meta[name='csrf-token']").attr("content"),

    }
    $.ajax({
      type:'POST',
      url:'/productos/create',
      data: data,
    }).then((data) => {
       alert("creado")
       $('#create-code').val(' ');
       $('#create-name').val(' ');
        $('#create-multi-unid').val(' ');
       $('#create-tipo-code').val(' ');
       $('#create-descripcion').val(' ');
       $('#create-peso').val(' ');
        $('#create-impuesto').val(' ');
       $('#create-code-arancelario').val(' ');
    })
  }
  function update() {
    const data = {
        CODI_RCODIGO: $('#edt-code').val(),
        CODI_RNOMBRE: $('#edt-name').val(),
        TUME_CODIGO: $('#edt-unid-media').val(),
        TUME_MULT: $('#edt-multi-unid').val(),
    //    TPCO_CODIGO: $('#edt-tipo-code').val(),
        CODI_RDESCRIP: $('#edt-descripcion').val(),
        CODI_PESO: $('#edt-peso').val(),
        CODI_RAFECTO5: $('#edt-afecto-adicional').val(),
        IMP_ADICIONAL: $('#edt-impuesto').val(),
        codi_arancelario: $('#edt-code-arancelario').val(),
        clco_codigo: $('#edt-clasificacion-producto').val(),
        clco_codigo2: $('#edt-clasificacion-mercancia').val(),
        prod_mayor: $('#edt-mayorista').val(),
        estado: $('#edt-state').val(),
        _token: $("meta[name='csrf-token']").attr("content")
    }
    let current = JSON.parse(localStorage.getItem('mercancia'));
    $.ajax({
      type:'POST',
      url:'/productos/update-one',
      data: data,
    }).then((data) => {

    })
  }
  function updateProduct(data) {
    $.ajax({
      type:'POST',
      url:'/productos/terminado/update',
      data: data,
    }).then((data) => {
      alert('producto actualizado')
    })
  }
  function getNutricional(id){
    $.ajax({
      type: 'GET',
      url: '/productos/nutricionals',
      data: {id: id},
    }).then((data) => {
      $('#info-code').val(data[0].codigo)
      $('#info-porcion').val(data[0].porcion)
      $('#info-calorias').val(data[0].energia)
      $('#info-grasas-totales').val(data[0].grasa_total)
      $('#info-grasas-saturadas').val(data[0].ac_grasa_sat)
      $('#info-grasas-trans').val(data[0].ac_grasa_trans)
      $('#info-mono-insaturada').val(data[0].ac_grasa_mono)
      $('#info-poli-saturada').val(data[0].ac_grasa_poli)
      $('#info-colesterol').val(data[0].colesterol)
      $('#info-sodio').val(data[0].sodio)
      $('#info-total-carbohidratos').val(data[0].hidrato_carbono)
      $('#info-azucar').val(data[0].azucar)
      $('#info-proteinas').val(data[0].proteina)
      $('#info-vitamina-a').val(data[0].vitaminaa)
      $('#info-vitamina-c').val(data[0].vitaminac)
      $('#info-calcio').val(data[0].calcio)
      $('#info-hierro').val(data[0].hierro)
    })
  }
  function getUnidadMedida(id) {
    $.ajax({
      type: 'GET',
      url: '/productos/unidades/list'
    }).then((data) => {
      const html = setUnidad(data);
      $('#edt-unid-media').empty().append(html);
    })
  }
  function getClasificacion() {
    $.ajax({
      type: 'GET',
      url: '/clasificacion/list'
    }).then((data) => {
      const html = setHTMLCla(data);
      $('#edt-clasificacion-producto').empty().append(html);
    })
  }
  function getClasificacion2() {
    $.ajax({
      type: 'GET',
      url: '/clasificacion/list2'
    }).then((data) => {
      const html = setHTMLCla2(data);
      $('#edt-clasificacion-mercancia').empty().append(html);
    })
  }
  function setUnidad(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].TUME_CODIGO == current.TUME_CODIGO) {

        array[i] = `<option value='${data[i].TUME_CODIGO}' selected>${data[i].TUME_DESCR}</option>`;
      } else {
        array[i] = `<option value='${data[i].TUME_CODIGO}'>${data[i].TUME_DESCR}</option>`;
      }
    }

    return array;
  }
  function setHTMLCla(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].CLCO_CODIGO == current.clco_codigo) {
        array[i] = `<option value='${data[i].CLCO_CODIGO}' selected>${data[i].CLCO_DESCRIPCION}</option>`;
      } else {
        array[i] = `<option value='${data[i].CLCO_CODIGO}'>${data[i].CLCO_DESCRIPCION}</option>`;
      }
    }
    return array;
  }
  function setHTMLCla2(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].clco_codigo == current.clco_codigo2) {
        array[i] = `<option value='${data[i].clco_codigo}' selected>${data[i].clco_descripcion}</option>`;
      } else {
        array[i] = `<option value='${data[i].clco_codigo}'>${data[i].clco_descripcion}</option>`;
      }
    }
    return array;
  }
  function setCatalogoEstado(data) {
    let state;
    if (data == 1) {
       state = `<select class='form-control' name='estado' style='width: 70px'>
                  <option value='1' selected>Si</option>
                   <option value='0'>No</option>
                </select>`;
    }
    if(data == 0) {

     state = `<select class='form-control' name='estado' style='width: 70px'>
                 <option value='1' >Si</option>
                 <option value='0' selected>No</option>
               </select>`;
    }
    return state;
  }
  function setCatalogoTipo(data) {
     let tipo;
     if (data == 1) {
       tipo = `<select class='form-control' name='tipo' style='width: 120px'>
                <option value='1' selected>POR CAJA</option>
                <option value='2'>FACTORIZADO</option>
               </select>`;
     }
     if (data == 2) {
       tipo = `<select class='form-control' name='tipo' style='width: 120px'>
                <option value='1' >POR CAJA</option>
                <option value='2' selected>FACTORIZADO</option>
               </select>`;
     }
     return tipo;
   }
  function updateNutricional() {
    let data = {
      codigo: $('#info-code').val(),
      porcion: $('#info-porcion').val(),
      energia: $('#info-calorias').val(),
      grasa_total: $('#info-grasas-totales').val(),
      ac_grasa_sat: $('#info-grasas-saturadas').val(),
      ac_grasa_trans: $('#info-grasas-trans').val(),
      ac_grasa_mono: $('#info-mono-insaturada').val(),
      ac_grasa_poli: $('#info-poli-saturada').val(),
      colesterol: $('#info-colesterol').val(),
      sodio: $('#info-sodio').val(),
      hidrato_carbono: $('#info-total-carbohidratos').val(),
      azucar: $('#info-azucar').val(),
      proteina: $('#info-proteinas').val(),
      vitaminaa: $('#info-vitamina-a').val(),
      vitaminac: $('#info-vitamina-c').val(),
      calcio: $('#info-calcio').val(),
      hierro: $('#info-hierro').val(),
      _token: $("meta[name='csrf-token']").attr("content"),

    }
    $.ajax({
      type:'POST',
      url:'/products/nutricionals/update',
      data: data,
    }).then((data) => {

    })
  }

 })
