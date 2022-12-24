import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class Example extends Component{
    constructor(props) {
        super(props);
        if(user!=null)
        this.state = {
          text: "Welcome "+user+"!!!"
        };
        else
        this.state = {
            text: "Please Login Or Register To Use Our application"
          };
    }

    render(){
        return (
            <div className="container-fluid">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">
                                <h1 className='text-center text-gray-600 dark:text-gray-400'>Welcome To Our application</h1>
                                </div>
                            <div className="card-body text-gray-600 dark:text-gray-400">
                                <h2 className='text-center text-gray-600 dark:text-gray-400'>
                                    {this.state.text}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
