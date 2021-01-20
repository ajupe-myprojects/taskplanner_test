'use_strict';


class MainHome extends React.Component 
{
    constructor()
    {
        super()
        this.state = {
            tasks: null,
            logged: true,
        }
    }

    async componentDidMount()
    {
        const response = await fetch('/api/check_login.php', {method: 'GET', mode: 'same-origin', headers: {'Content-Type': 'application/json'}});
        const data = await response.json();
        this.setState({logged: data.error})
        const response_home = await fetch('/api/get_home_data.php', {method: 'GET', mode: 'same-origin', headers: {'Content-Type': 'application/json'}});
        const data_home = await response.json();
        this.setState({tasks: data_home.tasks})

    }
}