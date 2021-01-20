'use_strict';


class NavBar extends React.Component 
{
    constructor()
    {
        super()
        this.state = {
            logged: true,
            mail: ''
        }
    }

    async componentDidMount()
    {
        const response = await fetch('/api/check_login.php', {method: 'GET', mode: 'same-origin', headers: {'Content-Type': 'application/json'}});
        const data = await response.json();
        this.setState({logged: data.error})
        if(data.mail)
        {
        this.setState({mail: data.mail})
        }
    }

    render()
    {
        let brand = e('a', {className: 'navbar-brand', href: '#', key: 'brand'}, 'Navbar');
        let home = e('li', {className: 'nav-item', children: e('a', {className: 'nav-link', href: '/home'}, 'Home'), key: 'home'});
        let user = e('li', {className: 'nav-item', children: e('a', {className: 'nav-link', href: '#'}, 'User'), key: 'user'});
        let stats = e('li', {className: 'nav-item', children: e('a', {className: 'nav-link', href: '#'}, 'Statistics'), key: 'stats'});
        if(!this.state.logged)
        {
            var log = e('li', {className: 'nav-item', children: e('a', {className: 'nav-link', href: '/logout'}, 'Logout'), key: 'log'});
        }
        else
        {
            var log = e('li', {className: 'nav-item', children: e('a', {className: 'nav-link', href: '/login_start'}, 'Login'), key: 'log'});
        }
        let bar = e('ul', {className: 'navbar-nav', children: [home, user, stats, log], key: 'bar'});
        let frame = e(
            'nav',
            {
                className: 'navbar navbar-expand-lg navbar-light bg-light',
                children: [brand, bar]
            },
        )

        return frame;
    }
}