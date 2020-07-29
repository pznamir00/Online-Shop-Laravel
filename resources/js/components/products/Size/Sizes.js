import React, { Component } from 'react';
import Form from './Form';


export default class Sizes extends Component {

  constructor() {
    super();
    this.state = {
      currentId: 0,
      sizes: {
        s0: {
          val: "",
          qty: "",
        }
      },
    };
  }

  componentDidMount(){
    if(this.props.sizes){
      this.setState({
        currentId: this.props.currentId,
        sizes: this.props.sizes,
      });
    }
  }

  async handleUpdate(e) {
    const { title } = e.target.dataset;
    const { type, value } = e.target;
    var { sizes } = this.state;
    if(type == "text") sizes[title].val = value;
    else sizes[title].qty = value;
    await this.setState({
      sizes: sizes,
    });
  }

  addRow() {
    this.state.currentId++;
    let newSizes = this.state.sizes;
    newSizes['s'+this.state.currentId] = {
      val: "",
      qty: "",
    }
    this.setState({
      sizes: newSizes,
    });
  }

  removeRow(e) {
    const sizesNumber = Object.keys(this.state.sizes).length;
    if(sizesNumber > 1){
      const cName = e.target.dataset.title;
      var allSizes = this.state.sizes;
      delete allSizes[cName];
      this.setState({
        sizes: allSizes,
      });
    }
  }

  render(){
    return (
      <Form
        addRow={this.addRow.bind(this)}
        sizes={this.state.sizes}
        update={this.handleUpdate.bind(this)}
        removeRow={this.removeRow.bind(this)}
      />
    );
  }
}
