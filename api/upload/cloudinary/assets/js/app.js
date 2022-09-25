const imagePreview = document.getElementById('cover');
const imageUploader = document.getElementById('img-uploader');
const upBar = document.getElementById('bar');

const CLOUD_URL='https://api.cloudinary.com/v1_1/vcardapp/image/upload';
const CLOUD_UPLOAD_PRESET='clrzlkjw';
imageUploader.addEventListener('change', async (e)=>{
    const file = e.target.files[0];

    const formData = new FormData();
    formData.append('file', file);
    formData.append('upload_preset', CLOUD_UPLOAD_PRESET);

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