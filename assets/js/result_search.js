import React from 'react';
import ReactDOM from 'react-dom';

$('#search-offer').submit( function(e) {
    e.preventDefault();

    var url = Routing.generate('add-offerType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        $('#all').hide();
        ReactDOM.render(<Ads_result  result={response['result']}/>, document.getElementById('searching'));
    }).fail(function(jxh,textmsg,errorThrown){
/*
         alert('Please fill in the mandatory cells in the search table!');
*/
    });
});

$('#search-demand').submit( function(e) {
    e.preventDefault();

    var url = Routing.generate('add-DemandType');
    var formSerialize = $(this).serialize();

    $.ajax({
        method: "post",
        dataType: "json",
        url: url,
        async: true,
        data:formSerialize,
    }).done( function(response) {
        $('#all').hide();
        ReactDOM.render(<Ads_result  result={response['result']}/>, document.getElementById('searching'));

    }).fail(function(jxh,textmsg,errorThrown){
        /*
                 alert('Please fill in the mandatory cells in the search table!');
        */
    });
});

class Ads_result extends React.Component {
    render() {
        const results = this.props.result;

        if(results.length !== 0 )
        {

            const ads = results.map( result =>{

                const id              = result.id ;
                const generalCategory = result.generalCategory  ;
                const category        = result.category;
                const imageOne        = result.imageOne ;
                const imageTow        = result.imageTow ;
                const imageThree      = result.imageThree  ;
                const price           = result.price   ;
                const pPrice          = result.pPrice  ;
                const city            = result.city     ;
                const ville           = result.ville  ;
                const dateOfAd        = result.dateOfAd  ;
                const typeOfAd        = result.typeOfAd  ;

                var offerImage ;
                if (imageOne !== null){
                    offerImage = imageOne;
                }
                else{
                    if(imageTow !== null){
                        offerImage = imageTow;
                    }
                    else{
                        if(imageThree !== null){
                            offerImage = imageThree
                        }
                        else{
                            offerImage = "assets/images/icons/sansphoto.jpeg";
                        }
                    }
                }
                var demandImage = "assets/images/icons/search.jpg";
                var image;
                if(typeOfAd === 'Offer'){
                    image = offerImage;
                }
                else{
                    image = demandImage;
                }
                var oldPrice ;
                var newPrice;
                if(pPrice !== null){
                    oldPrice =  <span className="title-blue float-left"><del>{pPrice}€</del></span>;
                }
                if(pPrice !== null){
                    newPrice = <span className="title-rose float-left">{price }€</span>;
                }
                var place;
                if(city === null){
                    place = ville;
                }
                else{
                    place = city;
                }
                const url = Routing.generate('ad_show', {'id': id});
                return(

                    <div className="text-center col-md-3 px-md-2 my-2 ad_show" key={id}>
                        <div id="ad_index" className="ad_index">
                            <a href={url}>
                                <div className="px-2 border-ad">
                                    <div className="row">
                                        <div className="col-md-12 pt-2">
                                            <div className=" ">
                                                <b className="title-blue float-left">{ category }</b>
                                                <b className="float-right ">{dateOfAd}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-md-12">
                                            <img className="image_ad" src={image}/>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-md-8">
                                            {oldPrice}
                                            {newPrice}
                                        </div>
                                        <div className="col-md-4">
                                            <span className="float-right mt-3">{place}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                )
            });
            return (
                <div className="row">
                    {ads}
                </div>
            )
        }
        else{
            return (
                <div key={Math.random()+10}>
                    <h1> no results</h1>
                </div>
            );
        }

    }
}