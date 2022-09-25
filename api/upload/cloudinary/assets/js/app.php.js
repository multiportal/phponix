const imagePreview = document.getElementById('img-cover');
const imageUploader = document.getElementById('cover');
const upBar = document.getElementById('bar');


const host = window.location.host;
if(host!='localhost'){
    const CLOUD_URL='https://cloudvcard.000webhostapp.com/bloques/files/admin/backend.php?action=subir_cover';
}else{
    const CLOUD_URL='https://localhost/MisSitios/cloudphp/bloques/files/admin/backend.php?action=subir_cover';
}

//const CLOUD_UPLOAD_PRESET='clrzlkjw';
imageUploader.addEventListener('change', async (e)=>{
    const file = e.target.files[0];

    const formData = new FormData();
    formData.append('file', file);
    //formData.append('upload_preset', CLOUD_UPLOAD_PRESET);

    const res = await axios.post(CLOUD_URL, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onUploadProgress(e){
            console.log(Math.round(e.loaded * 100)/e.total);
            const progreso = (Math.round(e.loaded * 100)/e.total);
            upBar.setAttribute('value',progreso);
        }
    });
    console.log(res);
    imagePreview.src=res.data.secure_url;

});