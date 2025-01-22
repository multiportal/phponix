const imagePreview = document.getElementById('img-cover');
const imageUploader = document.getElementById('cover');
const upBar = document.getElementById('bar');
const proyecto = 'apirestm/api';
const host = window.location.host;
const urlServer =  host!='localhost' ? 'https://cloudvcard.000webhostapp.com':'http://localhost/MisSitios/'+proyecto;
const CLOUD_URL= urlServer + '/upload/files/includes/backend.php?proyecto='+proyecto;
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
    imagePreview.src = res.data.url;//res.data.secure_url;
});