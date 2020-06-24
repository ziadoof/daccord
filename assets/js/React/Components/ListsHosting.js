import React from 'react';
import Translator from "bazinga-translator";

class ListsHosting extends React.Component {
    constructor(props) {
        super();
        this.state = {
            currentPage: 1,
            itemPerPage: 20,
            totalPage :1,
        };
        this.state.totalPage = Math.ceil(props.result.length / this.state.itemPerPage);
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidUpdate(prevProps) {
        let newProps = this.props.result.length;
        let oldProps = prevProps.result.length;
        // reset page if items array has changed
        if (newProps !== oldProps) {
            this.state.totalPage = Math.ceil(newProps / this.state.itemPerPage);
            this.setState({
                currentPage: Number(1)
            });
        }
    }

    handleClick(event) {
        if(event.target.id < 1 || event.target.id >this.state.totalPage || this.state.totalPage ===1){
            return;
        }
       this.setState({
            currentPage: Number(event.target.id)
        });
    }

    renderResult(items){

        return items.map((result) => {

            const id = result.id;
            const user = result.user;
            const imageHosting = result.image;
            const city = result.city;
            const userImage = result.userImage;
            const favorite = result.favorite;

            let url = Routing.generate('hosting_show', {'id': id});

            let favoriteStatus;
            if(favorite === 'false'){
                favoriteStatus =
                    <form method="post" action="" className="d-inline js-favorite-add float-right mt-1 mr-1" data-object={id} data-type="hosting" data-favorite="false">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart "></span>
                            </div>
                        </div>
                    </form>;
            }
            else if(favorite === 'true'){
                favoriteStatus =
                    <form method="post" action="" className="d-inline js-favorite-add float-right mt-1 mr-1" data-object={id} data-type="hosting" data-favorite="true">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart active"></span>
                            </div>
                        </div>
                    </form>;
            }
            else{
                favoriteStatus = <div></div>;
            }

            return (
                <div className="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4" key={Math.random()}>
                    <div id="ad_index" className="ad_index shadow-border border-left">
                        <a href={url}>
                            <div className="row">
                                <div className="col-md-12">
                                    <img className="image_hosting_search" src={imageHosting}/>
                                </div>
                            </div>
                        </a>
                        <div className="row">
                            <div className="col-12 mt-1">
                                <div className="d-inline">
                                    <div className="btn-group">
                                        <div className="d-inline">
                                            <img className="vote-avatar ml-2 d-inline" src={userImage}/>
                                        </div>
                                        <div className=" d-inline">
                                            <small className="ml-2 blued d-block">{user}</small>
                                            <small className="ml-2 blued d-block">{city}</small>
                                        </div>
                                    </div>
                                    <div className="d-inline">
                                        {favoriteStatus}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )
        });
    }

    render()
    {

        if (this.props.result.length !== 0) {
            this.data = this.props.result;
            const { currentPage, itemPerPage } = this.state;

            // Logic for displaying Items
            const indexOfLastItem = currentPage * itemPerPage;
            const indexOfFirstItem = indexOfLastItem - itemPerPage;
            const currentItems = this.data.slice(indexOfFirstItem, indexOfLastItem);


            // Logic for displaying page numbers
            const pageNumbers = [];
            for (let i = 1; i <= Math.ceil(this.data.length / itemPerPage); i++) {
                pageNumbers.push(i);
            }

            const renderPageNumbers = pageNumbers.map(number => {
                return (
                        <li className={this.state.currentPage === number ? 'active page-item' : 'page-item'}key={number}>
                            <a  id={number} onClick={this.handleClick} className="page-link ">
                                {number}
                            </a>
                        </li>
                );
            });

            return (
                <div >
                    <div className="row" >
                        {this.renderResult(currentItems)}
                    </div>
                    <div className="pagination-search row justify-content-center mt-4">
                        <div className="navigation">
                            <nav>
                                <ul className="pagination justify-content-center">
                                    <li className="page-item">
                                        <a  id={this.state.currentPage-1} onClick={this.handleClick} className="page-link" >
                                            « {Translator.trans('Previous')}
                                        </a>
                                    </li>
                                    {renderPageNumbers}
                                    <li className="page-item">
                                        <a  id={this.state.currentPage+1} onClick={this.handleClick} className="page-link">
                                            {Translator.trans('Next')} »
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            );
        } else {
            return (
                <div key={Math.random()}>
                    <h1 className="text-center">{Translator.trans('There is no results ')}</h1>
                </div>
            );
        }
    }
}export default ListsHosting;
