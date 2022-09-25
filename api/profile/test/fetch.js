export const functionFetch = async (Api, endpoint, method, datos) => {
    const url = `${Api}/${endpoint}`;
    let token = localStorage.getItem("Token");
    const data = { ...datos, token };
    const config = (datos != null) ? {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    } : {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    };
    //try {} catch (error) {}
    const response = await fetch(url, config);
    if (!response.ok) {
        console.error('Error 404(Fetch): ');
        if (response == 'Unauthorized') {
            console.error('Error 401(Fetch): ');
        } else if (response == 'Forbidden') {
            console.error('Error 403(Fetch): ');
        } else if (response == 'Not Found') {
            console.error('Error 404(Fetch): ');
        }
    } else {
        const data = await response.json();//console.log(res);
        return data;
    }
}

export const fetchProfile = async (Api, info) => {
    const {data} = await functionFetch(Api, 'profile/index.php', 'POST', '');//console.log('Profile:',data);
    switch (info) {
        case 'InfoUser':
            return data.InfoUser;
        break;
        case 'InfoToken':
            return data.InfoToken;
        break;
        default:
            return data;
        break;
    }
}