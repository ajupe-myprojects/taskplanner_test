'use_strict'

class LoginForm extends React.Component 
{
    constructor(props)
    {
        super();
        this.state = {
            usermail: '',
            umail_check: false,
            pw: '',
            token: '',
            pw_check: false,
            form: new FormData(),
        }
    }

    async componentDidMount()
    {
        const response = await fetch('/api/check_login.php', {method: 'GET', mode: 'same-origin', headers: {'Content-Type': 'application/json'}});
        const data = await response.json();
        this.setState({token: data.crsf_token})
    }

    

    check_email()
    {
        let tmp_val = $('#email').val();
        let tmp_test = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

        if(tmp_val !== '' && tmp_val.match(tmp_test))
        {
            this.setState({usermail: tmp_val});
            this.setState({umail_check: true});
        }
        else
        {
            this.setState({usermail: ''});
            this.setState({umail_check: false});
        }
        
    }

    check_pw()
    {
        let tmp_val = $('#pw').val();

        //pw test for testing purposes
        let tmp_test = /^(?=.{6,})/;

        //Strong pw test (prod)
        //let temp_test = /^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])/;

        if(tmp_val !== '' && tmp_val.match(tmp_test))
        {
            this.setState({pw: tmp_val})
            this.setState({pw_check: true});
        }
        else
        {
            this.setState({pw: ''})
            this.setState({pw_check: false});
        }
        
    }


    async handle_form()
    {
        if(this.state.umail_check && this.state.pw_check)
        {
            this.state.form.append('crsf-token', this.state.token);
            this.state.form.append('usermail', this.state.usermail);
            this.state.form.append('password', this.state.pw);

            const response = await fetch('/api/log_in.php', {
                method: 'POST',
                body: this.state.form,
            });
            const fb = await response.json();

        }
    }

    render()
    {
        let card_head = e(
            'div',
            {
                className: 'card-header p-2',
                children: [
                    e('h4', {key: 'ch4'}, 'Login')
                ],
                key: 'card_head'
            }
        );

        let form_name = e(
            'div',
            {
                key: 'form_name',
                className: 'form-group row',
                children: e(
                    'div',
                    {
                        className: 'col-6',
                        key: 'form_name_col',
                        children: [
                            e('label', {htmlFor: 'email', key: 'label_email'}, 'E-mail: *'),
                            e('input', {type: 'email', key: 'inp_mail', id: 'email', onChange: () => {this.check_email()}, className: (!this.state.umail_check ? 'form-control is-invalid': 'form-control')})
                        ]
                    }
                )
            },

        );

        let form_pw = e(
            'div',
            {
                key: 'form_pw',
                className: 'form-group row',
                children: e(
                    'div',
                    {
                        className: 'col-6',
                        key: 'form_pw_col',
                        children: [
                            e('label', {htmlFor: 'pw', key: 'label_pw'}, 'Password: *'),
                            e('input',{type: 'password', key: 'inp_pw', id: 'pw',onChange: () => {this.check_pw()}, className: !this.state.pw_check ? 'form-control is-invalid' : 'form-control'}),
                        ]
                    }
                )
            }
        );

        let form_button = e(
            'div',
            {
                key: 'form_bt',
                className: 'form-group row',
                children: e(
                    'div',
                    {
                        className: 'col-6',
                        key: 'form_bt_col',
                        children: e(
                            'button',
                            {
                                key: ' bt_sub',
                                className: 'btn btn-primary',
                                type: 'submit',
                                onClick: e => {e.preventDefault(); this.handle_form();location.reload();},
                            },
                            'Login'
                        )
                    }
                )
            }
        )

        let card_body = e(
            'div',
            {
                className: 'card-body',
                children: [
                    e(
                        'form',
                        {
                            method: 'POST',
                            children: [form_name, form_pw, form_button]
                            ,
                            key: 'form'
                        },

                    )
                ],
                key: 'card_body'
            }
        );

        let frame = e(
            'div',
            {
                className: 'container pt-3',
                children: e(
                    'div',
                    {
                        className: 'card',
                        children: [card_head,card_body]
                    }
                )
            }
        );

        return frame;
    }

}