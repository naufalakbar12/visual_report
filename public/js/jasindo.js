$('.btn-hapus-dataset').click(function () {
    let kode = $(this).data("kode")
    let btnHapus = $('#hapusModal a')
    btnHapus.attr("href", "http://localhost:8080/user/dataset/"+kode+"/hapus")
})
$('.btn-hapus-datavisual').click(function () {
    let kode = $(this).data("kode")
    let btnHapus = $('#hapusModal a')
    btnHapus.attr("href", "http://localhost:8080/admin/visual/"+kode+"/hapus")
})