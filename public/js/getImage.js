const changeImage = (e) => {
    console.log('change')
    var imgEle = document.getElementById('newimage')
    imgEle.src = URL.createObjectURL(e.target.files[0])
    imgEle.onload = () => {
        URL.revokeObjectURL(output.src)
    }
}