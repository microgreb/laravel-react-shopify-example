import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Autocomplete from 'react-autocomplete'

export default class Example extends Component {

    constructor(props) {
        super(props);

        this.state = {
            customer: {
                full_name: '',
                phone: ''
            },
            customers: [
                {
                    full_name: '',
                    phone: '',
                    isLeader: true
                },
            ],
            value: '',
            suggestions: []
        };

        this.getSuggestions();

        this.onSuggestSelect = this.onSuggestSelect.bind(this);
    }

    getSuggestions() {
        axios.get('/api/customers/simple').then((res) => {
            this.setState({suggestions: res.data.data});
        })
    }

    submitForm() {
        console.log('submitform');
        axios.post('/api/submissions', {submissions: this.state.customers}).then((res) => {
            console.log(res);
        })
    }

    handleCustomerNameChange(index, event) {
        let customers = this.state.customers.slice();
        customers[index].full_name = event.target.value;
        this.setState({customers: customers});
    }

    handleCustomerPhoneChange(index, event) {
        let customers = this.state.customers.slice();
        customers[index].phone = event.target.value;
        this.setState({customers: customers});
    }

    onSuggestSelect(event, index, value, suggested) {
        let customers = this.state.customers.slice();
        customers[index].full_name = suggested.full_name;
        customers[index].phone = suggested.phone;
        this.setState({customers: customers});
    }

    addCustomerRow() {
        this.setState(state => ({
            customers: [...state.customers, Object.create(state.customer)]
        }));
    }

    removeCustomerRow(index, event) {
        console.log(index, event);
        let customers = [...this.state.customers]; // make aay separate copy of the arr
        customers.splice(index, 1);
        this.setState({customers: customers});
    }

    render() {
        let component = this;
        let autocompleteInputProps = {
            className: 'form-control'
        };

        return (
            <div>
                <div className="row justify-content-md-center">
                    <div className="col-md-6 items-container">
                        <h2>Please, fill out the form</h2>

                        {this.state.customers.map((customer, index) => {
                            return (
                                <div key={index} className="form-item">
                                    <div className="form-group autocomplete">
                                        <label>Name</label>
                                        <button onClick={this.removeCustomerRow.bind(this,index)}
                                                type="button" className="close pull-right" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <Autocomplete
                                            inputProps={autocompleteInputProps}
                                            wrapperStyle={{}}
                                            shouldItemRender={(item, customer) => {
                                                return customer.length > 0;
                                            }}
                                            getItemValue={(item) => item.full_name}
                                            items={this.state.suggestions}
                                            renderItem={(item, isHighlighted) =>
                                                <div key={item.full_name}
                                                     className={item.full_name.toLowerCase().includes(customer.full_name.toLowerCase()) ? 'suggestion' : 'hidden'}
                                                     style={{background: isHighlighted ? 'lightgray' : 'white'}}>
                                                    {item.full_name}
                                                </div>
                                            }
                                            value={customer.full_name}
                                            onChange={this.handleCustomerNameChange.bind(this, index)}
                                            onSelect={(item, label) => component.onSuggestSelect(this, index, item, label)}
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label>Phone</label>
                                        <input
                                            onChange={this.handleCustomerPhoneChange.bind(this, index)}
                                            value={customer.phone}
                                            type='text'
                                            className="form-control"
                                            placeholder='Phone'/>
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>
                <div className="row justify-content-md-center">
                    <div className="col-md-6">
                        <button type="submit" className="btn btn-success"
                                onClick={this.submitForm.bind(this)}>
                            Submit
                        </button>
                        <button type="submit" className="btn btn-primary float-right"
                                onClick={this.addCustomerRow.bind(this)}>
                            Add Row
                        </button>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example/>, document.getElementById('example'));
}
