import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import { ImHome, ImArrowRight } from 'react-icons/im';

const Breadcrumbs = () => {
  const location = useLocation();
  const pathnames = location.pathname.split('/').filter(x => x);

  const breadcrumbNames = {
    'restoran': 'Restoran',
    'korpa': 'Korpa',
    'login': 'Prijava',
    'register': 'Registracija',
    'porudzbine': 'Moje Porudžbine'
  };

  return (
    <div className="breadcrumbs">
      <Link to="/" className="breadcrumb-item">
        <ImHome /> Početna
      </Link>
      
      {pathnames.map((name, index) => {
        const routeTo = `/${pathnames.slice(0, index + 1).join('/')}`;
        const isLast = index === pathnames.length - 1;
        const displayName = breadcrumbNames[name] || name;

        return (
          <React.Fragment key={routeTo}>
            <ImArrowRight className="breadcrumb-separator" />
            {isLast ? (
              <span className="breadcrumb-item active">{displayName}</span>
            ) : (
              <Link to={routeTo} className="breadcrumb-item">
                {displayName}
              </Link>
            )}
          </React.Fragment>
        );
      })}
    </div>
  );
};

export default Breadcrumbs;

