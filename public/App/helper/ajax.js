export async function Ajax(props){
    let {url, method,headers,cbSuccess} = props;
        await fetch(url)
            .then(response => response.ok ? response.json() : Promise.reject(response))
            .then(json => cbSuccess(json))
            .catch(err => {
                console.log(err)
            })
}
