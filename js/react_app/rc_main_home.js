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
        this.handleStateChange = this.handleStateChange.bind(this);
    }

    handleStateChange(data)
    {
        this.setState({tasks: data})
    }


    async componentDidMount()
    {
        
        const response_home = await fetch('/api/get_home_data.php', {method: 'GET', mode: 'same-origin', headers: {'Content-Type': 'application/json'}});
        const data_home = await response_home.json();
        if('log' in data_home)
        {
            this.setState({logged: data_home.log.error})
        }
        if('data' in data_home)
        {
            this.setState({tasks: data_home.data})
        }


    }

    render()
    {
        if(this.state.tasks !== null && this.state.logged == 'logged')
        {
            var list = new TaskList({tasks: this.state.tasks, handleStateChange: this.handleStateChange});

            var list_frame = list.get_list();
        }
        else
        {
            var list_frame = e('div', {key: 'test', className: 'text-center text-warning'}, 'You are not logged in. Please log in!');
            console.log(ROOT_DIR)
        }
        
        let frame = e(
            'div', 
            {
                className: 'container pt-4',
                children: list_frame
            }
            );
        
        return frame;
    }
}